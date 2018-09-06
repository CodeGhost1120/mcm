set :application, 'mcmstag.nclud.com'              # Should match directory name in vhosts
set :deploy_to, "/var/www/vhosts/mcmstag.nclud.com"
set :branch, 'production'
server 'mcmstag.nclud.com', roles: %w{web app db}  # Must match the host name provided by operations.
after "deploy:publishing", "deploy:robots"