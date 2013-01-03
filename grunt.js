module.exports = function(grunt) {
    grunt.initConfig({
        less: {
            app: {
                options: {
                  // yuicompress: true, //Use for production
                    paths: ['styles/less']
                },
                files: {
                    'styles/css/header.css': 'styles/less/header.less',
                    'styles/css/reset.css': 'styles/less/reset.less',
                    'styles/css/style.css': 'styles/less/style.less'
                }
            }
        },
        coffee: {
            app: {
                src: ['scripts/coffee/script.coffee'],
                dest: 'scripts/js'
            }
        },
        concat: {
            css: {
                src: ['styles/css/*.css'],
                dest: 'style.css'
            },
            js: {
                src: ['scripts/js/*.js'],
                dest: 'scripts/main.js'
            }
        },
        watch: {
            less: {
                files: ['styles/less/*'],
                tasks:'less concat'
            },
            js: {
                files: ['scripts/coffee/*'],
                tasks:'coffee concat'
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-coffee');


    grunt.registerTask('default', ['less', 'coffee', 'concat']);
}
