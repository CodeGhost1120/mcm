set :application, 'mcm.nclud.com'              # Should match directory name in vhosts
set :deploy_to, "/var/www/vhosts/mcm.nclud.com"
set :branch, 'staging'
server 'mcm.nclud.com', roles: %w{web app db}  # Must match the host name provided by operations.
after "deploy:publishing", "deploy:robots"