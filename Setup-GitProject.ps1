param (
    [string]$ProjectName = "MyProject",
    [string]$GitHubUser = "raybot1972",
    [switch]$Private,
    [switch]$NetworkShare
)

# Check for GitHub CLI
if (-not (Get-Command gh -ErrorAction SilentlyContinue)) {
    Write-Host "❌ GitHub CLI (gh) not found. Please install it from https://cli.github.com/" -ForegroundColor Red
    return
}

# Check if authenticated
$authStatus = gh auth status 2>&1
$notLoggedIn = $authStatus | Select-String "You are not logged into any GitHub hosts"
if ($notLoggedIn) {
    Write-Host "GitHub CLI not authenticated. Launching login prompt..." -ForegroundColor Yellow
    gh auth login
}


if (-not (Test-Path ".git")) {
    Write-Host "📁 Initializing in current folder: $PWD" -ForegroundColor Cyan
} else {
    Write-Host "📁 Git already initialized here." -ForegroundColor Green
}

# Initialize Git with main branch
git init -b main

# Mark network share as safe if flagged
$fullPath = (Resolve-Path ".").Path
if ($NetworkShare) {
    Write-Host "Marking network share as safe for Git..." -ForegroundColor Yellow
    git config --global --add safe.directory "$fullPath"
}

# Create .gitignore
@"
# Ignore WIP folder
_WIP/
"@ | Set-Content .gitignore

# Create README
"# $ProjectName" | Set-Content README.md

# Stage and commit
git add .
git commit -m "Initial commit with .gitignore and main branch"

# Determine visibility
if ($Private) {
    $visibility = "--private"
} else {
    $visibility = "--public"
}

# Create GitHub repo and push
gh repo create "$GitHubUser/$ProjectName" $visibility --source=. --remote=origin --push