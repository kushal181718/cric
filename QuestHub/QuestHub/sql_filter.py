import re

def testing(input_str):
    pattern = re.compile(r'\b(union|select|from|where|insert|delete|update|drop|truncate|alter|create|exec)\b', re.IGNORECASE)
    if re.search(pattern, input_str):
        return False
    else:
        return True
user_input = input("Enter your query: ")

if testing(user_input):
    print("impuyt is safe.")
else:
    print("input is having  SQL injecton keywords.")



