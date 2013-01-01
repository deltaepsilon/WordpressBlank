module.exports = function(grunt) {
    grunt.initConfig({
        less: {
            app: {
                options: {
                  // yuicompress: true, //Use for production
                    paths: ['../css']
                },
                files: {
                    'css/header.css': 'less/header.less',
                    'css/reset.css': 'less/reset.less',
                    'css/style.css': 'less/style.less'
                }
            }
        },
        coffee: {
            app: {
                src: ['coffee/script.coffee'],
                dest: 'js'
            }
        },
        concat: {
            css: {
                src: ['css/*.css'],
                dest: 'style.css'
            },
            js: {
                src: ['js/*.js'],
                dest: 'script.js'
            }
        },
        watch: {
            less: {
                files: ['less/*'],
                tasks:'less concat'
            },
            js: {
                files: ['coffee/*'],
                tasks:'coffee concat'
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-coffee');


    grunt.registerTask('default', ['less', 'coffee', 'concat']);
}
