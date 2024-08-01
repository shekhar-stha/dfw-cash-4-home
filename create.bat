@echo off
setlocal

:: Directory where the files will be created (change as needed)
set target_dir=C:\path\to\your\directory

:: List of file names
set files=(
    sell-my-house-glenn-heights.html
    sell-my-house-granbury.html
    sell-my-house-hickory-creek.html
    sell-my-house-highland-park.html
    sell-my-house-lakewood-village.html
    sell-my-house-lucas.html
    sell-my-house-mclendon-chisholm.html
    sell-my-house-northlake.html
    sell-my-house-oak-point.html
    sell-my-house-paloma-creek.html
    sell-my-house-paloma-creek-south.html
    sell-my-house-pantego.html
    sell-my-house-parker.html
    sell-my-house-princeton.html
    sell-my-house-prosper.html
    sell-my-house-providence-village.html
    sell-my-house-red-oak.html
    sell-my-house-richland-hills.html
    sell-my-house-river-oaks.html
    sell-my-house-roanoke.html
    sell-my-house-shady-shores.html
    sell-my-house-sunnyvale.html
    sell-my-house-trophy-club.html
    sell-my-house-university-park.html
    sell-my-house-watauga.html
    sell-my-house-white-settlement.html
    sell-my-house-willow-park.html
)

:: Create each file
for %%f in %files% do (
    echo Creating %%f...
    echo ^<html^>^<head^>^<title^>%%~nf^</title^>^</head^>^<body^>^<h1^>%%~nf^</h1^>^</body^>^</html^> > "%target_dir%\%%f"
)

echo All files created successfully.
endlocal
pause
