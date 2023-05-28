import psycopg2

# Connect to the database
conn = psycopg2.connect(
    host='your_host',
    port='your_port',
    database='your_database',
    user='your_user',
    password='your_password'
)

# Create a cursor object
cursor = conn.cursor()

# Read the SQL script file
script_file = open('example.sql', 'r')
sql_script = script_file.read()
script_file.close()

# Execute the SQL script
cursor.execute(sql_script)

# Commit the changes
conn.commit()

# Close the cursor and the connection
cursor.close()
conn.close()
