#!/bin/bash

function check_unreleased() {
    if grep -q '<!-- unreleased -->' CHANGELOG.md; then
        return 0
    else
        return 1
    fi
}

function delete_unreleased() {
    sed -i '1,/^<!-- unreleased -->/ { d; }' CHANGELOG.md
}

function check_tag() {
    
    tag_without_v="${tag#v}"
    echo "tag: ${tag_without_v}"

    if grep -q "## ${tag_without_v}" CHANGELOG.md; then
        echo "El tag está presente en CHANGELOG.md"
        return 1  
    else
        echo "El tag no está presente en CHANGELOG.md"
        return 0  
    fi
}


# Si existe la línea <!-- unreleased --> en el archivo borra desde el inicio hasta esa línea
if check_unreleased; then
    echo "Y la línea <!-- unreleased --> está presente en CHANGELOG.md"
    delete_unreleased;
fi
# Obtiene el último tag
tag=$(git for-each-ref --sort=-taggerdate --format '%(refname:short)' refs/tags | head -n 1)


if check_tag; then # comprueba si el tag ya esta en el archivo para no agregarlo de nuevo
    git cliff -c devops/changelog/cliff.toml -l --prepend CHANGELOG.md
else
        echo "no hay tag."
        git cliff -c devops/changelog/cliff.toml --unreleased --tag unreleased --prepend CHANGELOG.md
fi
