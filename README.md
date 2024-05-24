# Neutomic Skeleton

This is a skeleton project for Neutomic. It is a simple project that demonstrates how to use Neutomic to build a simple web application.

## Getting Started

To get started, clone this repository and run the following command:

```bash
compser install
```

This will install all the dependencies required to run the project.

## Running the Project

To run the project, run the following command:

```bash
php src/main.php http:server:start
```

This will start the server on port 8080. You can access the server by visiting `http://localhost:8080` in your browser.

### Server Clustering

To utilize server clustering, which dispatches multiple workers each running a server:

```bash
php src/main.php http:server:cluster
```

The command will dispatch `n` workers, where `n` is the number of CPU cores on your machine.

Alternatively, specify the number of workers:

```bash
php src/main.php http:server:cluster --workers=4
```

This will start the server cluster with 4 workers, each handling incoming requests concurrently.

## More Information

For more information on how to use Neutomic, please visit the [Neutomic Documentation](https://neutomic.github.io/).

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
