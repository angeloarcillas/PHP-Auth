# !NOTE: wip, check https://github.com/zerexei/php-core for base updated version

# PHP-Auth

## Feature
* Login
* Logout
* Register
* Forgot
* Change password
* Email Verification




## Schema
**AuthsController**
```
GET /auth/register                  @showRegisterForm          # show register form
POST /auth/register                 @store                     # register user

GET //authlogin                     @showLoginForm             # show login form
POST /auth/login                    @login                     # log in user

POST /auth/logout                   @logout                    # log out user

GET /auth/email/verify              @showSendVerifymForm       # show verify form
POST /auth/email/verify             @sendVerifyLink            # re-send verify to user

GET /auth/password/reset            @showResetLinkForm         # show link request form
POST /auth/password/email           @sendResetLink             # send reset link

GET /auth/password/reset/{token}    @showResetForm             # show reset password form
POST /auth/password/reset           @resetPassword             # reset password
```
