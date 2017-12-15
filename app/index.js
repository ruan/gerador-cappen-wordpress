'use strict';
var util = require('util');
var path = require('path');
var yeoman = require('yeoman-generator');
var chalk = require('chalk');

var CappenWordpressGenerator = yeoman.generators.Base.extend({

    promptUser: function() {
        var done = this.async();
        var prompts = [
            {
                name: 'appName',
                message: 'Qual é o nome do site?'
            },
            {
                type: 'checkbox',
                name: 'plugins',
                message: 'Quais plugins você irá utilizar?',
                choices: [
                    {
                        name: "Greensock JS",
                        value: "greensock"
                    },
                    {
                        name: "Select 2",
                        value: "select2"
                    },
                    {
                        name: "Parsley js",
                        value: "parsleyjs"
                    },
                    {
                        name: "Wow animations",
                        value: "wow"
                    },
                    {
                        name: "Owl carrosel 2",
                        value: "owl-carousel2"
                    }
                ]
            }
        ];
        this.prompt(prompts, function (props) {
            this.name = props.appName;
            this.slug = this._.slugify(props.appName);
            this.plugins = props.plugins;
            done();
        }.bind(this));
    },
    copyMainFiles: function(){
        this.fs.copy(
            this.templatePath('**'),
            this.destinationPath('')
        )

        var comment = '/*\n';
            comment += 'Theme Name: ' + this.name + '\n';
            comment += 'Author: Cappen\n';
            comment += 'Author URI: http://cappen.com/\n';
            comment += 'Version: 1.0.0\n';
            comment += '*/';

        var context = {
            slug: this.slug,
            theme_info: comment
        };

        this.template(".env.example");
        this.template(".gitignore");
        this.template("app/style.css", "app/style.css", context);
        this.template("app/functions.php", "app/functions.php", context);
        this.template("bower.json", "bower.json", context);
        this.template("composer.json", "composer.json", context);
        this.template("package.json", "package.json", context);

        this._.templateSettings.interpolate = /<\:(.+?)\:>/g;
        this._.templateSettings.escape = /<\:-(.*?)\:>/g;
        this._.templateSettings.evaluate = /<\:=(.*?)\:>/g;

        this.template("Gruntfile.js", "Gruntfile.js", context);
    },
    installPlugins: function(){
        this.bowerInstall(this.plugins,{save:true});
        this.npmInstall();
    },
    install() {
        this.spawnCommand('composer', ['install']);
    }
});

module.exports = CappenWordpressGenerator;
