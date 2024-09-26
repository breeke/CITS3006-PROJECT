import sys

# XOR encryption/decryption function
def xor_encrypt(data, key):
    return bytearray([b ^ key for b in data])

# Encrypt or decrypt the payload (in-place)
def encrypt_or_decrypt_in_place(input_file, key, mode):
    with open(input_file, 'rb') as f:
        data = f.read()

    encrypted_data = xor_encrypt(data, key)

    # Overwrite the original file with the encrypted or decrypted data
    with open(input_file, 'wb') as f:
        f.write(encrypted_data)

    if mode == 'encrypt':
        print(f"File '{input_file}' has been encrypted in place.")
    elif mode == 'decrypt':
        print(f"File '{input_file}' has been decrypted in place.")

if __name__ == '__main__':
    if len(sys.argv) < 4:
        print("Usage: crypter.py <encrypt|decrypt> <input_file> <key>")
        sys.exit(1)

    mode = sys.argv[1]
    input_file = sys.argv[2]
    key = int(sys.argv[3])  # XOR key (can be any integer between 0-255)

    # Perform either encryption or decryption based on the mode
    if mode == 'encrypt':
        encrypt_or_decrypt_in_place(input_file, key, mode)
    elif mode == 'decrypt':
        encrypt_or_decrypt_in_place(input_file, key, mode)
    else:
        print("Invalid mode. Use 'encrypt' or 'decrypt'.")
