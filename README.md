# Instructions

Create an ASP.Net MVC application that allows end-users to track vehicles they own and the MPG they are 
currently experiencing on that vehicle.

- Users must authenticate with the system and will be either a standard user or an administrator.
- Standard users may perform the following operations 
    - View their vehicles. Each vehicle is identified with a Make (Toyota, MINI, Chevrolet, etc.) and the MPG.
    - Add a new vehicle, choosing the Make from a list and entering the MPG.
    - Edit an existing vehicle, changing the MPG, but not the make.
    - Delete a vehicle.
- Administrators may perform the standard user operations and additionally may: 
    - Edit the set of known makes, adding, editing, or deleting makes.
    - Generate a report of the minimum, maximum, and average MPG of all vehicles in the system by make.

The candidate is responsible for designing the data model and choosing an appropriate storage mechanism for
persisting the data.

## Export SQL

```
    vendor/bin/doctrine orm:schema-tool:create --dump-sql
```


## License

The MIT License (MIT)

Copyright (c) 2015 Jamie Isaacs <pdt256@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
