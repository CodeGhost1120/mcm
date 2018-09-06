set :application, 'mcm.nclud.com'              # Should match directory name in vhosts
set :deploy_to, "/var/www/vhosts/mcm.nclud.com"
set :branch, 'production'
role :web, %w{mcm1.browsermedia.com mcm2.browsermedia.com mcm3.browsermedia.com mcm4.browsermedia.com mcm5.browsermedia.com}

