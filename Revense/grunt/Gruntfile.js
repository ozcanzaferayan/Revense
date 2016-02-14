module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    '../public/style/main.css': '../public/style/main.scss',
                    '../public/style/adm.css': '../public/style/adm.scss'
                }
            }
        },
        uglify: {
            options: {
                mangle: false
            },
            uglify_js_files: {
                files: {
                    '../scripts/main.min.js': '../scripts/main.js',
                    '../scripts/app.min.js': '../scripts/app.js'
                }
            }
        },
        watch: {
            watch_js_files: {
                files : ['../scripts/*.js'],
                tasks : ['uglify']
            },
            watch_sass_files: {
                files : ['../public/style/*.scss'],
                tasks : ['sass']
            }
        }
    });
    
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    
    grunt.registerTask('default', ['watch']);
};