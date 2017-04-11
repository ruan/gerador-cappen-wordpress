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
                name: 'appName',
                message: 'Qual é o nome do site?'
            },
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
    scaffoldFolders: function(){
        // this.mkdir("app");
        // this.mkdir("app/classes");
        // this.mkdir("app/fonts");
        // this.mkdir("app/img");
        // this.mkdir("app/paginas/home");
        // this.mkdir("app/scripts/vendor");
        // this.mkdir("app/scss");
        // this.mkdir("app/scss/components");
        // this.mkdir("app/scss/layouts");
    },
    copyMainFiles: function(){
        // this.copy("_gitignore", ".gitignore");
        this.fs.copy(
            this.templatePath('*'),
            this.destinationPath('')
        )
        var context = {
            site_name: this.appName,
            id:this._.underscored(this.appName).replace(/_/g,'-')
        };

        // this.template("_index.php", "app/index.php", context);
        // this.template("_bower.json", "bower.json", context);
        // this.template("_package.json", "package.json", context);
        // this.template("_gruntfile.js", "Gruntfile.js", context);
    },
    installPlugins: function(){
        this.bowerInstall(this.plugins,{save:true});
        this.npmInstall();
    }
});

module.exports = CappenSiteGenerator;
