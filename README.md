## Get Started

This guide will walk you through the steps needed to get this project up and running on your local machine.

### Prerequisites

Before you begin, ensure you have the following installed:

- Docker
- Docker Compose

### Building the Docker Environment

Build and start the containers:

```
docker-compose up -d --build
```

### Installing Dependencies

```
docker-compose exec app sh
composer install
```

### Database Setup

Set up the database:

```
bin/cake migrations migrate
```

### Accessing the Application

    The application should now be accessible at http://localhost:34251

    I have sucessfully implemented the RESTful API for the User Authentiction, Article Management and Like Feature as the mentioned requirements.

### How to Check Authentication Behavior:

- To test the authentication behavior, the Bearer token type was used, and form details were sent in JSON format.

### User Authentication:

### Register:

- Endpoint            : http://localhost:34251/login
- Method              : POST 
- Authentication      : No authentication required.
- Check               : Verify that the response includes an authentication token upon successful registration.
- Sample data         :

```
{
    "email"     : "test@gmail.com",
    "password"  : "password"
}
```

- Sample Output       : 

```
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyLCJleHAiOjE3MTAzMTY0NTksImlhdCI6MTcwOTcxMTY1OSwiaXNzIjoieW91cl9pc3N1ZXIifQ.PdHWRPxGyb2aLxPNwOStwsc7kZTedsmfE_XqioOc65E"
}
```

### Login:

- Endpoint            : http://localhost:34251/login
- Method              : POST 
- Authentication      : No authentication required.
- Check               : Verify that the response includes an authentication token upon successful login.
- Sample data         : 

```
{
    "email"     : "test@gmail.com",
    "password"  : "password"
}
```

- Sample Output       : 

```
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyLCJleHAiOjE3MTAzMTY0NTksImlhdCI6MTcwOTcxMTY1OSwiaXNzIjoieW91cl9pc3N1ZXIifQ.PdHWRPxGyb2aLxPNwOStwsc7kZTedsmfE_XqioOc65E"
}
```

### Logout:

- Endpoint            : http://localhost:34251/user/logout
- Method              : DELETE 
- Authentication      : Bearer token authentication required.
- Check               : Verify that the response includes the message "User has been logged out."
- Sample data         : No need to send the user id with the request the auth takes the bearer token.
- Sample Output       :

```
{
    "success": "User has been logged out"
}
```

### Check Article Management Behavior:

### Get All Articles:

- Endpoint            : http://localhost:34251/articles.json
- Method              : GET 
- Test Endpoint       : http://localhost:34251/articles.json
- Authentication      : No authentication required (noauth).
- Check               : Verify that the response contains the list of articles, confirming successful access without authentication.
- Sample Output       :

```
[
    {
        "id": 1,
        "user_id": 3,
        "title": "Updated Title",
        "body": "This is an updated article body.",
        "created_at": "2024-03-05T12:00:00+00:00",
        "updated_at": "2024-03-05T12:00:00+00:00"
    },
    {
        "id": 3,
        "user_id": 1,
        "title": "Sample Article",
        "body": "This is a sample article body.",
        "created_at": "2024-03-05T12:00:00+00:00",
        "updated_at": "2024-03-05T12:00:00+00:00"
    },
]
```

### Get Single Article:

- Endpoint            : http://localhost:34251/articles/{id}.json
- Method              : GET 
- Test Endpoint       : http://localhost:34251/articles/1.json
- Authentication      : No authentication required.
- Check               : Ensure the response includes the details of the specified article, indicating unrestricted access.
- Sample Output       : 

```
{
    "id": 1,
    "user_id": 3,
    "title": "Updated Title",
    "body": "This is an updated article body.",
    "created_at": "2024-03-05T12:00:00+00:00",
    "updated_at": "2024-03-05T12:00:00+00:00"
}
```

### Create Articles:

- Endpoint            : http://localhost:34251/articles.json
- Method              : POST 
- Test Endpoint       : http://localhost:34251/articles.json
- Authentication      : Bearer token authentication required.
- Check               : Confirm that a valid bearer token is provided in the request header, and the response indicates successful article addition.
- Sample data         :

```
{
    "title" : "Sample Article",
    "body"  : "This is a sample article body."
}
```

- Sample Output       :

```
{
    "message": "The article has been saved."
}
```

### Update Articles:

- Endpoint            : http://localhost:34251/articles/{id}.json
- Method              : PUT
- Test Endpoint       : http://localhost:34251/articles/1.json
- Authentication      : Bearer token authentication required.
- Check               : Validate that the request includes a valid bearer token and that the response indicates successful article modification.
- Sample data         :

```
{
    "title" : "Updated Article",
    "body"  : "This is an updated article body."
} 
```

- Sample Output       :

```
{
    "message": "The article has been updated."
}
```

### Delete Articles:

- Endpoint            : http://localhost:34251/articles/{id}.json
- Method              : DELETE 
- Test Endpoint       : http://localhost:34251/articles/1.json
- Authentication      : Bearer token authentication required.
- Check               : Validate that the request includes a valid bearer token and Ensure that the response confirms the deletion of the specified article.
- Sample Output       :

```
{
    "message": "The article has been deleted."
}
```

### Check Like Feature Behavior:

- Implemented the authenticated users can like all articles, including their own.
- Implemented the authenticated users can like an article only once.
- Implemented the authenticated users can’t cancel like.
- Implemented the all users can see like count on an article.

### Add Like:

- Endpoint            : http://localhost:34251/likes
- Method              : POST 
- Test Endpoint       : http://localhost:34251/likes.
- Authentication      : Bearer token authentication required.
- Check               : Confirm that a valid bearer token is included in the request header and the response indicates successful addition of a like for the specified article.
- Sample data         : 

```
{
    "article_id" : "5"
}
```

Sample Output       : 

```
{
    "likes": 3
}
```
### Get Likes:

- Endpoint            : http://localhost:34251/likes/article_id.
- Method              : GET 
- Test Endpoint       : http://localhost:34251/likes/1.
- Authentication      : Bearer token authentication required.
- Check               : Confirm that a valid bearer token is included in the request header and Ensure that the response thet includes the details of likes.
- Sample data         : Need to send the article_is with the endpoint
- Sample Output       : 

```
{
    "likesCount": 1
}
```

### Make Unlikes:

- Endpoint            : http://localhost:34251/likes/article_id.
- Method              : DELETE 
- Test Endpoint       : http://localhost:34251/likes/1.
- Authentication      : Bearer token authentication required.
- Check               : Confirm that a valid bearer token is included in the request header and Ensure that the response thet includes the details of likes.
- Sample data         : Need to send the article_is with the endpoint
- Sample Output       :

```
{
    "error": "'You can't cancel like on this article!"
}
```