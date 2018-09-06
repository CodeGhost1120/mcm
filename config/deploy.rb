# config valid only for Capistrano 3.1
#lock '3.4.0'

set :repo_url, 'git@github.com:nclud/mcm.git'

# Default branch is :master
#ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }.call

# Default deploy_to directory is /var/www/my_app
#set :deploy_to, '/var/www/vhosts/staging.thirdway.nclud.com'

# Default value for :scm is :git
set :scm, :git

# Default value for :format is :pretty
# set :format, :pretty

# Default value for :log_level is :debug
# set :log_level, :debug

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# set :linked_files, %w{config/database.yml}

# Default value for linked_dirs is []
set :linked_dirs, ['craft/storage', 'htdocs/assets/cms', 'htdocs/uploads']

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
 set :keep_releases, 20

set :format, :pretty
set :log_level, :info

set :user, ENV["USER"]
set :tmp_dir, "/tmp/#{fetch(:user)}/"

namespace :deploy do
  desc "Uploads different robots.txt to staging or production"
  task :robots do
  on roles(:all) do {
#    puts "Uploading custom robots.txt for #{fetch(:stage)}"
#    put content, "#{current_path}/htdocs/robots.txt"
  }  
  end
end
end