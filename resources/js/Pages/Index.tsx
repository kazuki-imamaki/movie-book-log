import Authenticated from "@/Layouts/Authenticated";
import AddModal from "../Components/AddModal";
import Switch from "../Components/Switch";
import Card from "../Components/Card";
import Loading from "../Components/Loading";
import ImageResults from "../Components/ImageResults";
import { Head } from "@inertiajs/react";
import { useEffect, useState } from "react";
import axios from "axios";

const Index = (props: any) => {
    // console.log(props);

    const [editFlag, setEditFlag] = useState(false);

    const [searchFlag, setSearchFlag] = useState(false);

    const [doneFlag, setDoneFlag] = useState(false);

    const [showModal, setShowModal] = useState(false);

    const [loading, setLoading] = useState(false);

    const [postData, setPostData] = useState({
        title: "",
        memo: "",
        poster_path: "",
        userId: props.auth.user.id,
        is_done: 0,
        editFlag: 0,
        date: "",
        star: 0,
    });

    const [putData, setPutData] = useState({
        id: 0,
        title: "",
        memo: "",
        poster_path: "",
        userId: props.auth.user.id,
        is_done: 0,
        editFlag: 0,
        date: "",
        star: 0,
    });

    const [contents, setContents] = useState([
        {
            title: "",
            memo: "",
            poster_path: "",
            is_done: "",
            date: "",
            star: 0,
        },
    ]);

    const [results, setResults] = useState([
        {
            adult: false,
            backdrop_path: "",
            genre_ids: [],
            id: 0,
            original_language: "",
            original_title: "",
            overview: "",
            popularity: 0,
            poster_path: "",
            release_date: "",
            title: "",
            video: false,
            vote_average: 0,
            vote_count: 0,
        },
    ]);

    useEffect(() => {
        axios.get("/api/want").then((res) => {
            console.log(res.data);
            setContents(res.data);
        });
    }, []);

    const getWant = async () => {
        await axios.get("/api/want").then((res) => {
            setContents(res.data);
        });
        setDoneFlag(false);
    };

    const getDone = async () => {
        await axios.get("/api/done").then((res) => {
            setContents(res.data);
        });
        setDoneFlag(true);
    };

    return (
        <Authenticated
            auth={props.auth}
            showModal={showModal}
            setShowModal={setShowModal}
        >
            <Head title="Movie" />
            <>
                <AddModal
                    doneFlag={doneFlag}
                    showFlag={showModal}
                    setShowModal={setShowModal}
                    auth={props.auth}
                    postData={postData}
                    setPostData={setPostData}
                    setLoading={setLoading}
                    getWant={getWant}
                    getDone={getDone}
                    searchFlag={searchFlag}
                    setSearchFlag={setSearchFlag}
                    results={results}
                    setResults={setResults}
                    setPutData={setPutData}
                    putData={putData}
                    editFlag={editFlag}
                    setEditFlag={setEditFlag}
                />

                <ImageResults
                    searchFlag={searchFlag}
                    setSearchFlag={setSearchFlag}
                    results={results}
                    setResults={setResults}
                    setPostData={setPostData}
                    postData={postData}
                />

                <Loading loading={loading} />
                <Switch setDoneFlag={setDoneFlag} setContents={setContents} />
                <Card
                    contents={contents}
                    setPutData={setPutData}
                    setShowModal={setShowModal}
                    setEditFlag={setEditFlag}
                />
            </>
        </Authenticated>
    );
};
export default Index;
