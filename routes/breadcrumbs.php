<?php

use App\Models\Ticket\Ticket;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator  as Generator;
use App\Models\Auth\User\User;

Breadcrumbs::register('admin.users', function (Generator $breadcrumbs) {
    $breadcrumbs->push(__('views.admin.dashboard.title'), route('admin.dashboard'));
    $breadcrumbs->push(__('views.admin.users.index.title'));
});

Breadcrumbs::register('admin.users.show', function (Generator $breadcrumbs, $id) {
    $breadcrumbs->push(__('views.admin.dashboard.title'), route('admin.dashboard'));
    $breadcrumbs->push(__('views.admin.users.index.title'), route('admin.users'));
    $breadcrumbs->push(__('views.admin.users.show.title', ['name' => User::where('id', $id)->value('name')]));
});


Breadcrumbs::register('admin.users.edit', function (Generator $breadcrumbs, $id) {
    $breadcrumbs->push(__('views.admin.dashboard.title'), route('admin.dashboard'));
    $breadcrumbs->push(__('views.admin.users.index.title'), route('admin.users'));
    $breadcrumbs->push(__('views.admin.users.edit.title', ['name' => User::where('id', $id)->value('name')]));
});


Breadcrumbs::register('admin.tickets.index', function (Generator $breadcrumbs) {
    $breadcrumbs->push(__('views.admin.dashboard.title'), route('admin.dashboard'));
    $breadcrumbs->push(__('views.admin.tickets.index.title'));
});

Breadcrumbs::register('admin.tickets.create', function (Generator $breadcrumbs) {
    $breadcrumbs->push(__('views.admin.dashboard.title'), route('admin.dashboard'));
    $breadcrumbs->push(__('views.admin.tickets.index.title'), route('admin.tickets.index'));
    $breadcrumbs->push(__('views.admin.tickets.create.title'));
});

Breadcrumbs::register('admin.tickets.show', function (Generator $breadcrumbs, $id) {
    $breadcrumbs->push(__('views.admin.dashboard.title'), route('admin.dashboard'));
    $breadcrumbs->push(__('views.admin.tickets.index.title'), route('admin.tickets.index'));
    $breadcrumbs->push(__('views.admin.tickets.show.title'));
});

Breadcrumbs::register('admin.tickets.edit', function (Generator $breadcrumbs, $id) {
    $breadcrumbs->push(__('views.admin.dashboard.title'), route('admin.dashboard'));
    $breadcrumbs->push(__('views.admin.tickets.index.title'), route('admin.tickets.index'));
    $breadcrumbs->push(__('views.admin.tickets.edit.title', ['name' => Ticket::where('id', $id)->value('title')]));
});