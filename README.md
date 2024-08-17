# Laravel Gumroad License Manager

## Table of Contents
1. [Introduction](#introduction)
2. [Features](#features)
3. [Requirements](#requirements)
4. [Installation](#installation)
5. [Usage](#usage)
6. [API Endpoints](#api-endpoints)
    - [License Offer Endpoints](#license-offer-endpoints)
    - [Token Endpoints](#token-endpoints)
7. [Testing](#testing)
8. [Linting](#linting)
9. [License](#license)
10. [TODO](#todo)

## Introduction
Gumroad License Manager is a Laravel application designed to manage licenses for Figma users purchased via Gumroad. This project allows users to register, add licenses, and manage their premium status based on the latest licenses they own. The system supports multiple users per license and multiple licenses per user, providing a robust solution for managing Figma product licenses.

## Features
- **License Management**: Users can add their Gumroad licenses to the system, which stores all relevant details such as product information, purchase details, and usage.
- **Premium Status**: The system determines and updates users' premium status based on the latest active license.
- **Multiple Licenses and Seats**: Supports multiple licenses for different products and multiple seats per license, allowing shared use among users.
- **API Integration**: Integrates with Gumroad API to validate and retrieve license information.

## Requirements
- PHP ^8.2
- Composer
- Node.js & NPM/Yarn (for frontend assets)

## Installation
1. Clone the repository:
   ```bash
   git clone git@github.com:zendyani/Laravel-gumroad-license.git
   cd Laravel-gumroad-license
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Run post-installation scripts:
   ```bash
   composer run post-root-package-install
   ```

4. Create and set up the database:
   ```bash
   composer run post-create-project-cmd
   ```

## Usage
1. Start the development server:
   ```bash
   php artisan serve
   ```

2. Access the application at `http://localhost:8000`.

## API Endpoints

### License Offer Endpoints

#### Get License Offers
Retrieve license offers for a specific license group.

- **URL**: `/api/v1/license-offers/{licenseGroup}`
- **Method**: `GET`
- **Parameters**:
  - `licenseGroup`: The group of licenses to retrieve offers for. Must be a valid license group.
- **Responses**:
  - `200 OK`: Returns the license offers for the specified group.
  - `422 Unprocessable Entity`: Validation error for an invalid license group.

```php
Route::prefix('v1')->group(function () {
    Route::get('/license-offers/{licenseGroup}', LicenseOfferController::class);
});
```

### Token Endpoints

#### Get Token
Generate a token for a Figma user based on their license.

- **URL**: `/api/v1/token`
- **Method**: `POST`
- **Request Body**:
  - `id` (string, required): The Figma user ID.
  - `name` (string, required): The Figma user name.
  - `code` (string, required): The product code. Must be a valid license code.
- **Responses**:
  - `200 OK`: Returns the generated token.
  - `422 Unprocessable Entity`: Validation error for invalid input data.

```php
Route::prefix('v1')->group(function () {
    Route::post('/token', TokenController::class);
});
```

## Testing
Run the test suite:
```bash
php artisan test
```

## Linting
Run PHP CS Fixer:
```bash
composer lint
```

## TODO
- **Event System**: 
  - **Send Notifications on License Addition**: Implement an event system to send notifications when a new license is added.
  - **Send Notifications on License Expiry**: Implement notifications for when a license is nearing its expiry date.

## License
This project is licensed under the MIT License.
