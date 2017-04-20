'use strict';
var util = require('util');
var path = require('path');
var yeoman = require('yeoman-generator');
var chalk = require('chalk');

var CappenSiteGenerator = yeoman.generators.Base.extend({
    promptUser: function() {
        var done = this.async();
        var prompts = [
            {
                name: 'theme',
                message: 'Qual é o nome do tema?'
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
            this.theme   = props.theme;
            this.appName = props.appName;
            this.plugins = props.plugins;
            done();
        }.bind(this));
    },
    copyMainFiles: function(){
        // this.copy("_gitignore", ".gitignore");
        this.fs.copy(
            this.templatePath('*'),
            this.destinationPath('')
        )
        var context = {
            theme: this.theme,
            id:this._.underscored(this.appName).replace(/_/g,'-')
        };

        this.template("bower.json", "bower.json", context);
        this.template("package.json", "package.json", context);
        //this.template("Gruntfile.js", "Gruntfile.js", context);
    },
    installPlugins: function(){
        this.bowerInstall(this.plugins,{save:true});
        this.npmInstall();
    }
});

module.exports = CappenSiteGenerator;
