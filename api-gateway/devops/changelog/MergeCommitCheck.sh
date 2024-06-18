#!/bin/bash

parent_commit_count=$(git cat-file -p $BITBUCKET_COMMIT | grep -o -i parent | wc -l)

if [ "${parent_commit_count}" = "2" ]
then
    echo "Commit $BITBUCKET_COMMIT has two parents. Hence this is a merge commit"
    echo "Proceeding with build"
    pip install git-cliff
    ./devops/changelog/changelog.sh
    if [ -n "$(git status --porcelain)" ]; then
                git add CHANGELOG.md
                git commit -m "[skip ci] Updating CHANGELOG."
                git push origin HEAD:$BITBUCKET_BRANCH --force
              else
                echo "No hay cambios en el changelog."
    fi
else
    echo "Commit $BITBUCKET_COMMIT is not a merge commit, Exiting Build"
fi