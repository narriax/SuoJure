REM %USERPROFILE% = C:\Users\vrsim

%USERPROFILE%\AppData\Local\Atlassian\SourceTree\git_local\cmd\git.exe clone --branch 7.x https://git.drupalcode.org/project/drupal.git public_html
%USERPROFILE%\AppData\Local\Atlassian\SourceTree\git_local\cmd\git.exe clone --branch 7.x-1.x https://git.drupalcode.org/project/devel.git public_html/sites/all/modules/devel
%USERPROFILE%\AppData\Local\Atlassian\SourceTree\git_local\cmd\git.exe clone --branch 7.x-2.x https://git.drupalcode.org/project/module_filter.git public_html/sites/all/modules/module_filter
%USERPROFILE%\AppData\Local\Atlassian\SourceTree\git_local\cmd\git.exe clone --branch 7.x-1.x https://git.drupalcode.org/project/ctools.git public_html/sites/all/modules/ctools
pause