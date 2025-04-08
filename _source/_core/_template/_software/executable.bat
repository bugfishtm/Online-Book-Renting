@echo off
echo Set objShell = CreateObject("WScript.Shell") > temp.vbs
echo objShell.Popup "Hello, World!", 5, "Message", 64 >> temp.vbs
cscript //nologo temp.vbs
del temp.vbs
exit
