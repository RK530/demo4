<?php
use App\Models\User;
use App\Models\Employee;
use App\Models\Date;
use App\Models\tblTotoSite;
use App\Models\tblResultApi;
use App\Models\tblgzt;
use App\Models\tblqzt;
use App\Models\tblwzt;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});
// result_api
Breadcrumbs::for('result_api.index', function (BreadcrumbTrail $trail):void {
    $trail->parent('totoSite.index');
    $trail->push('Result Api ', route('result_api.index'));
});

Breadcrumbs::for('result_api.show', function (BreadcrumbTrail $trail, tblResultApi $result_api) {
    $trail->parent('result_api.index');
    $trail->push($result_api->id, route('result_api.show', $result_api));
});

Breadcrumbs::for('result_api.create', function (BreadcrumbTrail $trail) {
    $trail->parent('result_api.index');
    $trail->push('Create New Result Api', route('result_api.create'));
});

Breadcrumbs::for('result_api.edit', function (BreadcrumbTrail $trail,tblResultApi $result_api) {
    $trail->parent('result_api.index');
    $trail->push('Edit User', route('result_api.edit',$result_api));
});





//////User 
Breadcrumbs::for('user.index', function (BreadcrumbTrail $trail):void {
    $trail->parent('totoSite.index');
    $trail->push('User ', route('user.index'));
});

Breadcrumbs::for('user.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('user.index');
    $trail->push($user->id, route('user.show', $user));
});

Breadcrumbs::for('user.create', function (BreadcrumbTrail $trail) {
    $trail->parent('user.index');
    $trail->push('Create User', route('user.create'));
});

Breadcrumbs::for('user.edit', function (BreadcrumbTrail $trail,User $user) {
    $trail->parent('user.index');
    $trail->push('Edit User', route('user.edit',$user));
});


//dream
Breadcrumbs::for('dream.index', function (BreadcrumbTrail $trail):void {
    $trail->parent('totoSite.index');
    $trail->push('Dream ', route('dream.index'));
});

Breadcrumbs::for('dream.edit', function (BreadcrumbTrail $trail, tblgzt $dream) {
    $trail->parent('dream.index');
    $trail->push('Edit Dream', route('dream.edit',$dream));
});


//qzt
Breadcrumbs::for('qzt.index', function (BreadcrumbTrail $trail):void {
    $trail->parent('totoSite.index');
    $trail->push('Dream qzt', route('qzt.index'));
});

Breadcrumbs::for('qzt.edit', function (BreadcrumbTrail $trail, tblqzt $qzt) {
    $trail->parent('qzt.index');
    $trail->push('Edit Dream Qzt', route('qzt.edit',$qzt));
});



//dream wzt
Breadcrumbs::for('wzt.index', function (BreadcrumbTrail $trail):void {
    $trail->parent('totoSite.index');
    $trail->push('Dream Wzt', route('wzt.index'));
});

Breadcrumbs::for('wzt.edit', function (BreadcrumbTrail $trail, tblwzt $wzt) {
    $trail->parent('wzt.index');
    $trail->push('Edit Dream Wzt', route('wzt.edit',$wzt));
});



//resource
Breadcrumbs::for('totoSite.index', function (BreadcrumbTrail $trail):void {
   
    $trail->push('Toto Site', route('totoSite.index'));
});

Breadcrumbs::for('totoSite.show', function (BreadcrumbTrail $trail, tblTotoSite $totoSite) {
    $trail->parent('totoSite.index');
    $trail->push($totoSite->id, route('totoSite.show', $totoSite));
});

Breadcrumbs::for('totoSite.create', function (BreadcrumbTrail $trail) {
    $trail->parent('totoSite.index');
    $trail->push('Create New Toto Site', route('totoSite.create'));
});

Breadcrumbs::for('totoSite.edit', function (BreadcrumbTrail $trail,tblTotoSite $totoSite) {
    $trail->parent('totoSite.index');
    $trail->push('Edit Totot Site', route('totoSite.edit',$totoSite));
});

//draw date
Breadcrumbs::for('drawdate.index', function (BreadcrumbTrail $trail):void {
    $trail->parent('totoSite.index');
    $trail->push('Draw Date', route('drawdate.index'));
});


Breadcrumbs::after(function (BreadcrumbTrail $trail) {
    $page = (int) request('page', 1);
    
    if ($page > 1) {
        $trail->push("Page {$page}", null, ['current' => false]);
    }
});