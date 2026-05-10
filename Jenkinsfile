pipeline {
    agent any

    triggers {
        githubPush()
    }

    environment {
        GITHUB_TOKEN = credentials('github-token')
    }

    stages {
        stage('Checkout') {
            steps {
                echo 'Checking out source code from GitHub...'
                checkout scm
            }
        }

        stage('Verify Tools') {
            steps {
                echo 'Checking PHP and PHPUnit versions...'
                sh 'php -v'
                sh 'phpunit --version'
            }
        }

        stage('Verify GitHub Secret') {
            steps {
                echo 'Checking that GitHub token exists without printing it...'
                sh '''
                    if [ -z "$GITHUB_TOKEN" ]; then
                        echo "GitHub token is missing"
                        exit 1
                    else
                        echo "GitHub token is configured correctly"
                    fi
                '''
            }
        }

        stage('Run Unit Tests') {
            steps {
                echo 'Running PHPUnit tests...'
                sh 'phpunit --bootstrap tests/bootstrap.php tests'
            }
        }
    }

    post {
        success {
            echo 'Build succeeded. All unit tests passed.'
        }

        failure {
            echo 'Build failed. Check the PHPUnit error above.'
        }
    }
}
