# scripts/ai_integration.py
import sys, requests, json, io
from scraper_bot import search_and_extract

topic, material_type, with_search, lenght = sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4]
lenght = int(lenght)

background = ''
if with_search == '1':
    background = search_and_extract(topic)

if background:
    prompt = f"""
На основе информации из интернета создай {material_type} на тему "{topic}".

Информация:
{background}
"""
else:
    prompt = f"""
Создай {material_type} на тему "{topic}" без внешней информации. Используй базовые знания.
"""

data = {
    "model": "gemma-2-2b-it-Q5_K_M.gguf",
    "prompt": prompt,
    "temperature": 0.7,
    "max_tokens": 600
}

resp = requests.post("http://127.0.0.1:1234/v1/completions",
                     headers={"Content-Type": "application/json"},
                     data=json.dumps(data))
resp.raise_for_status()
result = resp.json()

sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
print(result["choices"][0]["text"].strip())
