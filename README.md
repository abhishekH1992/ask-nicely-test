# Ask Nicely

## Docker
```
docker-compose up --build
```

## .env
```
VUE_APP_API_URL=SET_DOCKER_URL
```

## VUE setup
```
npm install
```

### Run frontend
```
npm run serve
```

## Testing
In Sample CSV folder, there are number of csvs with different sceanrios

| Scenario | CSV | Result |
| ----------------------- |
| Empty Comany Name | AskNicely - No Comapny.csv | Fail |
| Empty Email Address | AskNicely - No Email.csv | Fail |
| False Email Address | AskNicely - False Email.csv | Fail |
| Empty Employee Name | AskNicely - No Name.csv | Fail |
| String Salary | AskNicely - String Salary.csv | Fail |
| Double Salary | AskNicely - Double Salary.csv | Fail |
| Well Formatted CSV | AskNicely.csv | Success |

```
Once correct CSV uploaded, then try to change email with existing email address from other users. It should fail to save email address.
```

## Future Improvements
1. Add a authentication to access API
2. Error messages