import mysql.connector
from datetime import datetime

# Replace these with your database connection details
host = "localhost"
user = "root"
password = ""
database = "kk"


def connect():
    try:
        connection = mysql.connector.connect(host=host,user=user,password=password,database=database)
        if connection.is_connected():
            print("Db Connected ")
            return connection
    except mysql.connector.Error as e:
        print("Error:", e)

def convert_to_flat_list(tuple_list):
    flat_list = [item for sublist in tuple_list for item in sublist]
    return flat_list

def getListOfProductId(conn):
    cursor = conn.cursor()
    query = f"SELECT product_id  FROM bids"
    cursor.execute(query)
    results = cursor.fetchall()
    return convert_to_flat_list(results)

def checkChangeTheStatus(conn, listOfProductId):
    for i in listOfProductId:
        cursor = conn.cursor()
        query_for_product = f"SELECT * FROM products WHERE id = {i}"
        cursor.execute(query_for_product)
        results = cursor.fetchall()
        for j in results:
            sellerId = j[0]
            endDate = j[9]
            database_date = endDate
            current_date = datetime.now()
            if database_date < current_date:
                listOfProductInBid = f"SELECT * FROM bids WHERE product_id = {i}"
                cursor.execute(listOfProductInBid)
                result = cursor.fetchall()
                tuple_with_highest_price = max(result, key=lambda item: item[3])
                winerId = tuple_with_highest_price[1]
                bidAmt = tuple_with_highest_price[3]
                newStatus = 2
                update_query = f"UPDATE bids SET status = {newStatus} WHERE user_id = {winerId}"
                cursor.execute(update_query)
                
                update_query1 = f"UPDATE bids SET seller_id = {sellerId} WHERE id = {winerId}"
                cursor.execute(update_query1)

                update_query2 = f"UPDATE products SET buyer_id = {winerId} WHERE id = {sellerId}"
                cursor.execute(update_query2)

                update_query3 = f"UPDATE products SET bid_amt = {bidAmt} WHERE id = {sellerId}"
                cursor.execute(update_query3)
                
                conn.commit()

    print("Data Updated Successfully.")    

connection = connect()
listOfProductId = getListOfProductId(connection)
checkChangeTheStatus(connection, listOfProductId)




