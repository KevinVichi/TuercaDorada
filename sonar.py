# Función con varios problemas

def process_data(data):
    # Variable no utilizada
    unused_var = 100

    # Falta de validación de tipo de dato
    if type(data) != str:
        return "Error: El dato debe ser una cadena de texto."

    # Llamada a una función que no existe
    result = multiply_data(data)

    # Devolución de resultado sin asegurarse de que sea un número
    return result

# Uso de la función
data = 42  # Esto no es una cadena, debería causar un error de tipo
output = process_data(data)
print(output)
