# PHP assignment 

All details described in task.pdf.


## endpoints examples
- Get all garages - `http://localhost:8080/garages`
- Get by country - `http://localhost:8080/garages/country/Finland`
- Get by owner - `http://localhost:8080/garages/owner/{owner}`
- Find by location `http://localhost:8080/garages/location/{lat},{lon}`

## Points to improve code

- add eloquent model for garages in case if we need to create 
- register normal container interface for db driver instead of string 'db'
- add migrations for php? 
- add interface for container proxy service
- add flexibility for filters e.g more params / validations
- pagination ?
- wrap up web/index.php into some static service & routes (make code looks more clear)
- add good CORS (now just copy-pasted from docs , sorry no time )
- add tables currencies/ owners / locations etc 

Proposals??


