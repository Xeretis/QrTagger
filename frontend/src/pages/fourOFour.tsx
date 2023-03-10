import { Button, Container, Group, Text, Title, createStyles } from "@mantine/core";

import { Link } from "react-router-dom";

const useStyles = createStyles((theme) => ({
    root: {
        paddingTop: 80,
        paddingBottom: 80,
    },
    label: {
        textAlign: "center",
        fontWeight: 900,
        fontSize: 220,
        lineHeight: 1,
        marginBottom: theme.spacing.xl * 1.5,
        color: theme.colorScheme === "dark" ? theme.colors.dark[4] : theme.colors.gray[2],

        [theme.fn.smallerThan("sm")]: {
            fontSize: 120,
        },
    },
    title: {
        fontFamily: `Greycliff CF, ${theme.fontFamily}`,
        textAlign: "center",
        fontWeight: 900,
        fontSize: 38,

        [theme.fn.smallerThan("sm")]: {
            fontSize: 32,
        },
    },
    description: {
        maxWidth: 500,
        margin: "auto",
        marginTop: theme.spacing.xl,
        marginBottom: theme.spacing.xl * 1.5,
    },
}));

const FourOFour = () => {
    const { classes } = useStyles();

    return (
        <Container className={classes.root}>
            <div className={classes.label}>404</div>
            <Title className={classes.title}>The page you're looking for doesn't exist...</Title>
            <Text color="dimmed" size="lg" align="center" className={classes.description}>
                You may have mistyped the address, or the page has been moved to another URL.
            </Text>
            <Group position="center">
                <Button component={Link} to={"/"} variant="subtle" size="md">
                    Take me back to home page
                </Button>
            </Group>
        </Container>
    );
};

export default FourOFour;
