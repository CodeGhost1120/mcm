set :application, 'staging.thirdway.nclud.com'              # Should match directory name in vhosts
set :deploy_to, "/var/www/vhosts/mcm.nclud.com"
ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }.call
server 'mcm.nclud.com', roles: %w{web app db}  # Must match the host name provided by operations.