workflow "test .workflow files" {
    on = "push"
    resolves = [
        "composer install"
    ]
}

action "composer install" {
    uses = docker://composer
    args = "install"
}
