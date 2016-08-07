#!/bin/bash

if [ ! -f "./app/jspm_packages/system.js" ]; then
    jspm install
fi

jspm bundle-sfx ./app/ApiConsoleView ../web/js/build/apiConsole.js
