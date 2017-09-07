require 'yaml'

config = {
  local: './vagrant/config/vagrant-local.yml'
}

options = YAML.load_file config[:local]

Vagrant.configure("2") do |config|
    
  config.vm.box = "bento/ubuntu-16.04"
  config.vm.box_check_update = options['box_check_update']
  config.vm.hostname = options['machine_name']
  config.vm.define options['machine_name']
  config.vm.network "public_network", bridge: "enp4s0"

  config.vm.provider "virtualbox" do |vb|
    vb.gui = false
    vb.memory = options['memory']
    vb.name = options['machine_name']
  end

  config.vm.synced_folder './', '/news', owner: 'vagrant', group: 'vagrant'
  config.vm.synced_folder '.', '/vagrant', disabled: true

  config.vm.provision 'shell', path: './vagrant/provision/once-as-root.sh', args: [options['timezone']]
  config.vm.provision 'shell', path: './vagrant/provision/once-as-vagrant.sh', args: [options['github_token']], privileged: false
  config.vm.provision 'shell', path: './vagrant/provision/always-as-root.sh', run: 'always'

  config.vm.provision "shell", inline: <<-SHELL
    apt-get update
    apt-get install zsh
    
  SHELL
end
