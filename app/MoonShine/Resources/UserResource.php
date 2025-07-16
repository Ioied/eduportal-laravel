<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\User;
use Illuminate\Validation\Rule;

// правильно — Laravel-адаптер
use MoonShine\Laravel\Resources\ModelResource;

// UI-поля в 3.x лежат в MoonShine\UI\Fields
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\Select;
use MoonShine\Fields;


/**
 * @extends ModelResource<User>
 */
class UserResource extends ModelResource
{
    protected string $model = User::class;
    protected string $title = 'Пользователи';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Имя', 'name')->sortable(),
            Email::make('Email', 'email')->sortable(),
            Text::make('Роль', 'role')->sortable(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Text::make('Имя', 'name')
                ->required()
                ->customAttributes(['maxlength' => 255, ]),
                //->rules(['required', 'string', 'max:255']), // для ещё и серверной валидации
            
            Email::make('Email', 'email')
                ->required(),

            Password::make('Пароль', 'password')
                    ->nullable(),
               
                
            Select::make('Роль', 'role')
                ->options([
                    'user'       => 'User',
                    'admin'      => 'Admin',
                    'super_user' => 'Super User',
                ])
                ->required(),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Имя', 'name'),
            Email::make('Email', 'email'),
            Text::make('Роль', 'role'),
            Text::make('Дата создания', 'created_at'),
            Text::make('Дата обновления', 'updated_at'),
        ];
    }

    public function rules($item): array
    {
        $id = $item->getKey();

        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'password' => [$id ? 'nullable' : 'required', 'string', 'min:8'],
            'role'     => ['required', Rule::in(['user','admin','super_user'])],
        ];
    }
}
