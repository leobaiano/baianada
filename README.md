# Baianada #

Base structure for creating plugins for WordPress

## Description ##

This project aims to provide the basic framework for creating a WordPress plugin.

The assets directory, as its name implies, should be used to hold the assets of the plugin. It has sub directories to better organize your files by type, they are: css, images and js. The JS file already behind a framework based on jQuery, ready to start writing your functions and a variable with the url of the `admin-ajax`.

The help directory back some classes stores classes and libraries to help create the plugin.

The main file, `baianada.php` behind a class for the plugin. In `__construct()` class has two actions calling methods to set the load text domain and the enqueue scripts to load the css and js plugin. Also behind the static method `get_instance()` is called out of class, with the action `plugins_loaded` that is called when loading plugins.

[I'm working on a script that will automate the customization of this base, changing the names and texts domain to avoid conflicts. The [Baianada Shell](https://github.com/leobaiano/baianada-shell) repository is also available and you can contribute if you want to help.

## Helper classes ##

### Post Type ###

The `LB_Post_Type()` class facilitates the creation of custom posts types which is a widely used resource in the development of plugins. The `Baianada()` class already boasts a method that loads all the classes available in helper, so you just need to create a new method to create the kinds custom posts of your plugin and load it with an action init in `__construct()` class.

Properties `LB_Post_Type()`

```
@param string $ slug - Slug CPT
@param string $ name - CPT name
@param array $ supports - Supports
#param string $ domain - Domain Text plugin
```

Example of creating CPT

```
//----- Outher Code ----
/**
 * Initialize the plugin
 */
private function __construct() {
	add_action( 'init', array( $this, 'cc_teste' ) );
}

//----- Outher Code ----

public function cc_teste() {
	new LB_Post_Type( 'schedule', 'Schedule', array( 'title', 'thumbnail' ), self::$text_domain );
}
```

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

