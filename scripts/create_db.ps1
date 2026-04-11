Write-Host "This will create the 'lifecare' database and user 'lifecare'@'localhost' (password: secret)."
Write-Host "Requires MySQL client (mysql) available in PATH."

$rootUser = Read-Host -Prompt "MySQL admin user (default: root)"
if ([string]::IsNullOrWhiteSpace($rootUser)) { $rootUser = 'root' }

$rootPwd = Read-Host -AsSecureString -Prompt "MySQL admin password"
$bstr = [System.Runtime.InteropServices.Marshal]::SecureStringToBSTR($rootPwd)
$plainPwd = [System.Runtime.InteropServices.Marshal]::PtrToStringAuto($bstr)

$sql = Get-Content -Raw -Path "$(Join-Path $PSScriptRoot 'create_db.sql')"
$oneLine = ($sql -replace "`r?`n", " ; ")

try {
    & mysql -u $rootUser -p$plainPwd -e $oneLine
    if ($LASTEXITCODE -eq 0) {
        Write-Host "Database and user created successfully."
    } else {
        Write-Error "mysql exited with code $LASTEXITCODE."
    }
} catch {
    Write-Error "Failed to run mysql client: $_"
}
