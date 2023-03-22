import Authenticated from "@/Layouts/Authenticated";
import Card from "../Components/Card";
import { Head } from "@inertiajs/react";
import { useEffect, useState } from "react";
import axios from "axios";
import Switch from "../Components/Switch";

const Index = (props: any) => {
    console.log(props);

    const [doneFlag, setDoneFlag] = useState(false);

    const [contents, setContents] = useState([
        {
            title: "",
            memo: "",
            poster_path: "",
            is_done: "",
            daet: "",
            star: 0,
        },
    ]);

    useEffect(() => {
        axios.get("/api/want").then((res) => {
            console.log(res.data);
            setContents(res.data);
        });
    }, []);

    return (
        <Authenticated auth={props.auth}>
            <Head title="Movie" />
            <>
                <Switch setDoneFlag={setDoneFlag} setContents={setContents} />
                <Card contents={contents} />
            </>
        </Authenticated>
    );
};
export default Index;
