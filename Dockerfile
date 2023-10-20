# Use an official PHP runtime as a parent image
FROM php:7.4

# Set the working directory
WORKDIR /application

# Copy your PHP application files into the container
COPY . .

# Install the PDO extension for MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Expose port 3000 for the PHP built-in server
EXPOSE 3000

# Command to run the PHP built-in server
CMD ["php", "-S", "0.0.0.0:3000", "-t", "public"]