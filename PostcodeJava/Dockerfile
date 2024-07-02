# Use the official maven/Java 17 image to build the application
FROM maven:3.8.1-openjdk-17-slim AS build

# Set the working directory inside the container
WORKDIR /app

# Copy the pom.xml and the source code into the container
COPY pom.xml .
COPY src ./src

# Package the application using Maven
RUN mvn clean package -DskipTests

# Use the official openjdk image to run the application
FROM openjdk:17-slim

# Set the working directory inside the container
WORKDIR /app

# Copy the jar file from the build stage
COPY --from=build /app/target/postcodedemo-0.0.1-SNAPSHOT.jar app.jar

# Expose port 8080
EXPOSE 8080

# Run the application
ENTRYPOINT ["java", "-jar", "app.jar"]
