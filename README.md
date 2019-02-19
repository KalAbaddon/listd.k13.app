# Hello Welcome to the GRAV CMS I configured to make checklist creation easy
### To add a new checklist you can send me the critical info with paste bin or github ect...
#### thats not to say I dont plan on adding more checklists my self and soon,  its just some people are good at repetive stuff and some are not. For example if I was cleaning I could strip and wax a floor all day long and be content,  but when typing and entering code, I just find it hard to do that repetive stuff like copy a line and paste it 60 times in a row. so help in that regard is most welcome!

Here is an example of how to format the data for an A-10C checklist (it is incomplete since it is an example).  
#### the spacing in the file is important.  It is a tab or 4 spaces forward to the -. and 2 tabs or 8 spaces forward to the Details: line.

```
checklist:
    -   step: 1. Set EAC Switch
        details: OFF
    -   step: 2. Set RADAR Switch
        details: ON
    -   step: 3. Set VHF radio 1 channel presets 
        details: Configure on VHF 1 Radio Panel (VHF AM). 
---

```


## Just write out the checklist as in the above example and I can finish the formatting.
### _remember all the checklists can just be copieded step for step, word for word from the documents in game for each module._


Below here is the orignal readme.md info from the CMS I am using GRAV,  it is what is enabling me to add checklists with such minimal formating required.  if you are looking to get in to blogging or something like it I recommend using this,  it is a little bit of a learning curve but it is a really nice pice of kit!


# ![](https://avatars1.githubusercontent.com/u/8237355?v=2&s=50) Grav

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/cfd20465-d0f8-4a0a-8444-467f5b5f16ad/mini.png)](https://insight.sensiolabs.com/projects/cfd20465-d0f8-4a0a-8444-467f5b5f16ad) [![Discord](https://img.shields.io/discord/501836936584101899.svg?logo=discord&colorB=728ADA&label=Discord%20Chat)](https://chat.getgrav.org) [![Build Status](https://travis-ci.org/getgrav/grav.svg?branch=develop)](https://travis-ci.org/getgrav/grav) [![OpenCollective](https://opencollective.com/grav/backers/badge.svg)](#backers) [![OpenCollective](https://opencollective.com/grav/sponsors/badge.svg)](#sponsors)

Grav is a **Fast**, **Simple**, and **Flexible**, file-based Web-platform.  There is **Zero** installation required.  Just extract the ZIP archive, and you are already up and running.  It follows similar principles to other flat-file CMS platforms, but has a different design philosophy than most. Grav comes with a powerful **Package Management System** to allow for simple installation and upgrading of plugins and themes, as well as simple updating of Grav itself.

The underlying architecture of Grav is designed to use well-established and _best-in-class_ technologies to ensure that Grav is simple to use and easy to extend. Some of these key technologies include:

* [Twig Templating](http://twig.sensiolabs.org/): for powerful control of the user interface
* [Markdown](http://en.wikipedia.org/wiki/Markdown): for easy content creation
* [YAML](http://yaml.org): for simple configuration
* [Parsedown](http://parsedown.org/): for fast Markdown and Markdown Extra support
* [Doctrine Cache](http://doctrine-orm.readthedocs.io/projects/doctrine-orm/en/latest/reference/caching.html): layer for performance
* [Pimple Dependency Injection Container](http://pimple.sensiolabs.org/): for extensibility and maintainability
* [Symfony Event Dispatcher](http://symfony.com/doc/current/components/event_dispatcher/introduction.html): for plugin event handling
* [Symfony Console](http://symfony.com/doc/current/components/console/introduction.html): for CLI interface
* [Gregwar Image Library](https://github.com/Gregwar/Image): for dynamic image manipulation

# Requirements

- PHP 5.6.4 or higher. Check the [required modules list](https://learn.getgrav.org/basics/requirements#php-requirements)
- Check the [Apache](https://learn.getgrav.org/basics/requirements#apache-requirements) or [IIS](https://learn.getgrav.org/basics/requirements#iis-requirements) requirements

# QuickStart

These are the options to get Grav:

### Downloading a Grav Package

You can download a **ready-built** package from the [Downloads page on https://getgrav.org](https://getgrav.org/downloads)

### With Composer

You can create a new project with the latest **stable** Grav release with the following command:

```
$ composer create-project getgrav/grav ~/webroot/grav
```

### From GitHub

1. Clone the Grav repository from [https://github.com/getgrav/grav]() to a folder in the webroot of your server, e.g. `~/webroot/grav`. Launch a **terminal** or **console** and navigate to the webroot folder:
   ```
   $ cd ~/webroot
   $ git clone https://github.com/getgrav/grav.git
   ```

2. Install the **plugin** and **theme dependencies** by using the [Grav CLI application](https://learn.getgrav.org/advanced/grav-cli) `bin/grav`:
   ```
   $ cd ~/webroot/grav
   $ bin/grav install
   ```

Check out the [install procedures](https://learn.getgrav.org/basics/installation) for more information.

# Adding Functionality

You can download [plugins](https://getgrav.org/downloads/plugins) or [themes](https://getgrav.org/downloads/themes) manually from the appropriate tab on the [Downloads page on https://getgrav.org](https://getgrav.org/downloads), but the preferred solution is to use the [Grav Package Manager](https://learn.getgrav.org/advanced/grav-gpm) or `GPM`:

```
$ bin/gpm index
```

This will display all the available plugins and then you can install one or more with:

```
$ bin/gpm install <plugin/theme>
```

# Updating

To update Grav you should use the [Grav Package Manager](https://learn.getgrav.org/advanced/grav-gpm) or `GPM`:

```
$ bin/gpm selfupgrade
```

To update plugins and themes:

```
$ bin/gpm update
```


# Contributing
We appreciate any contribution to Grav, whether it is related to bugs, grammar, or simply a suggestion or improvement! Please refer to the [Contributing guide](CONTRIBUTING.md) for more guidance on this topic.

## Security issues
If you discover a possible security issue related to Grav or one of its plugins, please email the core team at contact@getgrav.org and we'll address it as soon as possible.

# Getting Started

* [What is Grav?](https://learn.getgrav.org/basics/what-is-grav)
* [Install](https://learn.getgrav.org/basics/installation) Grav in few seconds
* Understand the [Configuration](https://learn.getgrav.org/basics/grav-configuration)
* Take a peek at our available free [Skeletons](https://getgrav.org/downloads/skeletons)
* If you have questions, jump on our [Discord Chat Server](https://chat.getgrav.org)!
* Have fun!

# Exploring More

* Have a look at our [Basic Tutorial](https://learn.getgrav.org/basics/basic-tutorial)
* Dive into more [advanced](https://learn.getgrav.org/advanced) functions
* Learn about the [Grav CLI](https://learn.getgrav.org/cli-console/grav-cli)
* Review examples in the [Grav Cookbook](https://learn.getgrav.org/cookbook)

# Backers
Support Grav with a monthly donation to help us continue development. [[Become a backer](https://opencollective.com/grav#backer)]

<img src="https://opencollective.com/grav/tiers/backers.svg?avatarHeight=36&width=600" />

# Sponsors
Become a sponsor and get your logo on our README on Github with a link to your site. [[Become a sponsor](https://opencollective.com/grav#sponsor)]

<img src="https://opencollective.com/grav/tiers/sponsors.svg?avatarHeight=36&width=600" />

# License

See [LICENSE](LICENSE.txt)


[gitflow-model]: http://nvie.com/posts/a-successful-git-branching-model/
[gitflow-extensions]: https://github.com/nvie/gitflow

# Running Tests

First  install the dev dependencies by running `composer update` from the Grav root.
Then `composer test` will run the Unit Tests, which should be always executed successfully on any site.
Windows users should use the `composer test-windows` command.
You can also run a single unit test file, e.g. `composer test tests/unit/Grav/Common/AssetsTest.php`
