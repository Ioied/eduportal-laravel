# scripts/scraper_bot.py
from duckduckgo_search import DDGS
import newspaper

def search_and_extract(query, max_results=3):
    summaries = []
    with DDGS() as ddgs:
        for r in ddgs.text(query, max_results=max_results):
            url = r.get('href') or ''
            try:
                art = newspaper.Article(url)
                art.download(); art.parse()
                summaries.append(f"Источник: {url}\n{art.text[:1000]}\n")
            except:
                continue
    return "\n---\n".join(summaries)

if __name__ == '__main__':
    import sys
    print(search_and_extract(sys.argv[1]))
