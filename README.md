FIND MY WAY

An indoor navigation web application to find all possible routes between the source (user coordinates) and the target (user destination). It displays the route traced by the user. Moreover, it takes into consideration the distances covered in every path and hence gives suggestions for the best feasible path based on the least distance. 

The frontend has a withstand against SQL injection attacks within a login page. The backend is handled by a MYSQL database to keep track of all routes ever traced by all users. 

Every user has to create an account and all the paths traced by him/her are recorded under his/her account. All such paths in the database participate impartially in the selection of the best route, as well as, mapping of all routes.

Its simple-in-design user interface makes it easy for any new user to figure out the step-by-step guide to the required location.

In case request for a route has been made for the first time, the user is at absoulute liberty to figure out the route, and simultaneously allowing the application to store the traced path in the database to be brought up whenever demanded from the next time.

The application chiefly uses JAVASCRIPT for coordinates location and tracing, HTML for displaying the data, PHP to connect the backend and frontend, MYSQL for database, CSS for styling.

