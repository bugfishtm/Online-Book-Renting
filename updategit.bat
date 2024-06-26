@echo off
cd /d %~dp0
echo ------------------------
echo Do you want this Repo
echo with version code 1.10.100?
echo ------------------------
pause
git add .
git commit -m "1.10.100"
git push -u origin main
pause