# laratickets
real time tickets system for laravel framework, this package is transformation from (https://github.com/thekordy/ticketit) using livewire concept

**Important note:** this package is under development and not completed yet

# Requirements:
- Laravel Livewire installed and configured in your project.
- Laravel Alpine.js installed and configured in your project.
- Laravel rappasoft/laravel-livewire-tables installed and configured in your project.
- Laravel spatie/laravel-permission installed and configured in your project.


## installation step:

`composer require asaydev/laratickets`

## Auto setup and configure

you need only to execute next command.

`php artisan laratickets:install`


## Manually setup

### publishing config file:

`php artisan vendor:publish --provider="AsayDev\LaraTickets\InftyLaraTicketsServiceProvider" --tag="config"`

### publishing migrations files:

`php artisan vendor:publish --tag=laratickets_migrations`

### publishing assets files:

`php artisan vendor:publish --tag=laratickets_assets`

### Basic usage

this package allow using tickets for spacific model

@livewire('lara-tickets-dashboard',['model'=>'modeName','model_id'=>'modelID'])

### ToDo
- adding mail notification on new ticket,update ticket, new comment

### ToBe explain
- options array parm
    - can_create_ticket
    
