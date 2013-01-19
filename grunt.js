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
            },
            mobile: {
                options: {
                    // yuicompress: true, //Use for production
                    paths: ['styles/less']
                },
                files: {
                    'styles/mobile/css/mobile-style.css': 'styles/mobile/less/mobile-style.less'
                }
            }
        },
        coffee: {
            app: {
                src: ['scripts/coffee/*.coffee'],
                dest: 'scripts/js'
            },
            mobile: {
                src: ['scripts/mobile/coffee/*.coffee'],
                dest: 'scripts/mobile/js'
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
            },
            mobile_css: {
                src: ['styles/mobile/css/*.css'],
                dest: 'mobile-style.css'
            },
            mobile_js: {
                src: ['scripts/js/contactForm.js', 'scripts/js/handlers.js', 'scripts/mobile/js/*.js'],
                dest: 'scripts/mobile.js'
            }
        },
        watch: {
            less: {
                files: ['styles/less/*', 'styles/mobile/less/*'],
                tasks:'less concat'
            },
            js: {
                files: ['scripts/coffee/*', 'scripts/mobile/coffee/*'],
                tasks:'coffee concat'
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-coffee');


    grunt.registerTask('default', ['less', 'coffee', 'concat']);
}
