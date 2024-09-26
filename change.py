from PIL import Image

def string_to_binary(message):
    # Convert each character to binary and join them together
    return ''.join(format(ord(char), '08b') for char in message)

def binary_to_string(binary_data):
    # Split binary data into bytes and convert them to characters
    all_bytes = [binary_data[i: i + 8] for i in range(0, len(binary_data), 8)]
    return ''.join([chr(int(byte, 2)) for byte in all_bytes])

def hide_message(image_path, message, output_path):
    # Open the image
    img = Image.open(image_path)
    img = img.convert('RGB')
    binary_message = string_to_binary(message) + '1111111111111110'  # Delimiter to indicate end of message
    data_index = 0
    pixels = img.load()

    for i in range(img.size[0]):
        for j in range(img.size[1]):
            if data_index < len(binary_message):
                r, g, b = pixels[i, j]
                
                # Modify the LSB of red channel
                r = (r & ~1) | int(binary_message[data_index])
                data_index += 1

                # Modify the LSB of green channel (if needed)
                if data_index < len(binary_message):
                    g = (g & ~1) | int(binary_message[data_index])
                    data_index += 1

                # Modify the LSB of blue channel (if needed)
                if data_index < len(binary_message):
                    b = (b & ~1) | int(binary_message[data_index])
                    data_index += 1
                
                # Update pixel
                pixels[i, j] = (r, g, b)

            if data_index >= len(binary_message):
                break

    img.save(output_path)
    print(f"Message hidden and saved in {output_path}")

def extract_message(image_path):
    img = Image.open(image_path)
    img = img.convert('RGB')
    binary_message = ""
    pixels = img.load()

    for i in range(img.size[0]):
        for j in range(img.size[1]):
            r, g, b = pixels[i, j]
            
            # Extract LSB of red, green, and blue channels
            binary_message += str(r & 1)
            binary_message += str(g & 1)
            binary_message += str(b & 1)

    # Find the delimiter to end the message
    delimiter = '1111111111111110'
    end_index = binary_message.find(delimiter)
    
    if end_index != -1:
        binary_message = binary_message[:end_index]
        return binary_to_string(binary_message)
    else:
        return "No hidden message found"

# Example usage:
hide_message('dictionary.png', 'this is my special key 098765432', 'dictionary2.png')
message = extract_message('dictionary2.png')
print("Extracted Message:", message)
