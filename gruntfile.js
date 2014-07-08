module.exports = function(grunt) {
    "use strict";

    grunt.initConfig({
        pkg : grunt.file.readJSON("package.json"), // = target vers le package
        watch : {
            scripts : {
                files : ["src/**/ *.php",
                         "src/**/*.phtml",
                         "src/**/*.js",
                         "src/**/*.css"
                        ],
                options : {
                    livereload : true
                }
            }
        }
    });

    grunt.loadNpmTasks("grunt-contrib-watch");
}