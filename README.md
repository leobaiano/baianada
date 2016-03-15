# Baianada #
Contributors: leobaiano
Donate link: http://leobaiano.com.br/donate
Tags: plugin WordPress, plugin, WordPress, Starter Plugin, Kick Starter Plugin
Stable tag: 1.0.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Base structure for creating plugins for WordPress

## Description ##

This project aims to provide the basic framework for creating a WordPress plugin.

The assets directory, as its name implies, should be used to hold the assets of the plugin. It has sub directories to better organize your files by type, they are: css, images and js. The JS file already behind a framework based on jQuery, ready to start writing your functions and a variable with the url of the `admin-ajax`.

The main file, `baianada.php` behind a class for the plugin. In `__construct()` class has two actions calling methods to set the load text domain and the enqueue scripts to load the css and js plugin. Also behind the static method `get_instance()` is called out of class, with the action `plugins_loaded` that is called when loading plugins.

## Contribute ##

You can contribute to the source code in our [GitHub](https://github.com/leobaiano/baianada) page.

1. Take a [fork](https://help.github.com/articles/fork-a-repo/) repository;
3. [Configure your](https://help.github.com/articles/configuring-a-remote-for-a-fork/);
2. Check [issues](https://github.com/WordPressBeloHorizonte/horizon-theme/issues) and choose one that does not have anyone working;
4. [Sincronize seu fork](https://help.github.com/articles/syncing-a-fork/);
2. Create a branch to work on the issue of responsibility: `git checkout -b issue-17`;
3. Commit the changes you made: `git commit -m 'Review commits you did'`;
4. Make a push to branch: `git push origin issue-17`;
5. Make a [Pull Request](https://help.github.com/articles/using-pull-requests/) :D

**Note:** If you want to contribute to something that was not recorded in the [issues](https://github.com/leobaiano/baianada/issues) it is important to create and subscribe to prevent someone else to start working on the same thing you.

If you need help performing any of the procedures above, please access the link and [learn how to make a Pull Request](https://help.github.com/articles/creating-a-pull-request/).

