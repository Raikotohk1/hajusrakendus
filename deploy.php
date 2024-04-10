<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('application', 'Hajusrakendus');
set('remote_user', 'virt118421');
set('http_user', 'virt118421');
set('keep_releases', 2);

host('ta22tohk.itmajakas.ee')
    ->setHostname('ta22tohk.itmajakas.ee')
    ->set('http_user', 'virt118421')
    ->set('deploy_path', '~/domeenid/www.ta22tohk.itmajakas.ee/hajus')
    ->set('branch', 'master');

set('repository', 'https://gitlab.com/RalfHei/hajusrakendus.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts


// Hooks

after('deploy:failed', 'deploy:unlock');
