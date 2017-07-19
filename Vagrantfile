# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|

    config.vm.box = "ubuntu/trusty64"

    config.vm.network "public_network"


    config.vm.synced_folder "./", "/home/vagrant/astropay", id: "vagrant-root",
                                                     :owner => "vagrant",
                                                     :group => "www-data",
                                                     :mount_options => ["dmode=775","fmode=664"]
    config.vm.synced_folder ".", "/vagrant", disabled:true


    config.vm.provider "virtualbox" do |vb|
    #   # Display the VirtualBox GUI when booting the machine
    #   vb.gui = true
    #
    #   # Customize the amount of memory on the VM:
     vb.memory = "1024"
    end

    config.vm.provision "shell", inline: <<-SHELL
        sudo su

        ###
        ###installation section
        ###

        apt-get update

        ###install php and nginx
        apt-get install -y php5 php5-cli php5-fpm php5-mysql php5-curl
        apt-get install -y nginx


    SHELL

end
