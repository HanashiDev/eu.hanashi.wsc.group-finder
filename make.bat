@ECHO OFF
del files.tar
7z a -ttar -mx=9 files.tar .\files\*
del templates.tar
7z a -ttar -mx=9 templates.tar .\templates\*
del eu.hanashi.wsc.group-finder.tar
7z a -ttar -mx=9 eu.hanashi.wsc.group-finder.tar .\* -x!files -x!templates -x!eu.hanashi.wsc.group-finder.tar -x!.git -x!.gitignore -x!make.bat