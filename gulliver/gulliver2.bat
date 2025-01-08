@ECHO OFF
for %%F in (%0) do set dirname=%%~dpF
SET PHP_PATH="D:\Developing\wamp\bin\php\php5.6.40"
SET PHP_BIN="D:\Developing\wamp\bin\php\php5.6.40\php.exe"
SET PATH_GULLIVER="%dirname%\"
SET PATH_GULLIVER_BIN="%dirname%bin\gulliver"
SET PATH=%PATH%;%PHP_PATH%;%PATH_GULLIVER_BIN% 
%PHP_BIN% %PATH_GULLIVER_BIN% %1 %2 %3 %4 %5 %6 %7 %8 %9
pause